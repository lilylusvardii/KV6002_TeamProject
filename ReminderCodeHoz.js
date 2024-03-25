require('dotenv').config();
const express = require('express');
const cors = require('cors');
const sqlite3 = require('sqlite3').verbose();
const twilio = require('twilio');
const app = express();
app.use(cors());

// Initialize Twilio client
const twilioClient = new twilio('AC3ac89a780083b70ff78362038796e9d7', 'edd8da305f965427994391ba3b001537');

// Initialize SQLite database
const db = new sqlite3.Database('em2.sqlite', sqlite3.OPEN_READWRITE, (err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Connected to the em2.sqlite SQLite database.');
});

// Function to check for upcoming events and send an SMS
function checkAndSendSMSForUpcomingEvents() {
    const query = `
        SELECT * FROM events
        WHERE date >= datetime('now') AND date < datetime('now', '+24 hours')
    `;

    db.all(query, [], (err, rows) => {
        if (err) {
            console.error('Error executing query', err.message);
            return;
        }

        if (rows.length > 0) {
            const messageBody = `Reminder: You have events coming up within the next 24 hours!`;
            const toPhoneNumber = '+447521480807'; // The fixed phone number to send the SMS to

            // Send SMS using Twilio
            twilioClient.messages.create({
                body: messageBody,
                to: toPhoneNumber, // The recipient's number
                from: '+447449615948', // Your Twilio number
            })
            .then(message => console.log(`Message sent with SID: ${message.sid}`))
            .catch(error => console.error('Error sending SMS:', error));
        } else {
            console.log('No events found within the next 24 hours.');
        }
    });
}

// Example route to trigger the check (consider securing this endpoint)
app.get('/sendEventReminders', (req, res) => {
    checkAndSendSMSForUpcomingEvents();
    res.send('Check for upcoming events initiated.');
});

const PORT = process.env.PORT || 3006;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));

// Remember to handle database connection closure properly in your real application
// Especially when shutting down your server
