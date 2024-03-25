require('dotenv').config();
const express = require('express');
const twilio = require('twilio');
const cors = require('cors');

const app = express();
app.use(cors());

// Twilio setup
const twilioClient = new twilio('AC3ac89a780083b70ff78362038796e9d7', 'edd8da305f965427994391ba3b001537');

function checkAndSendSMSForUpcomingEvents() {
    // Simulating database response with an array of events
    // Assume these are the results of querying the database for events within the next 24 hours
    const mockedDbResponse = [
        { eventName: 'Community Meeting', date: '2024-03-25T10:00:00Z' },
        { eventName: 'Pregent People', date: '2024-03-25T15:00:00Z' }
    ];

    if (mockedDbResponse.length > 0) {
        mockedDbResponse.forEach(event => {
            const messageBody = `Reminder: You have an upcoming event '${event.eventName}' on ${event.date}.`;
            const toPhoneNumber = '+447521480807'; // The phone number to send the SMS to

            // Send SMS using Twilio
            twilioClient.messages.create({
                body: messageBody,
                to: toPhoneNumber, // Replace with the recipient's number
                from: '+447449615948', // Replace with your Twilio number
            })
            .then(message => console.log(`Message sent with SID: ${message.sid}`))
            .catch(error => console.error('Error sending SMS:', error));
        });
    } else {
        console.log('No events found within the next 24 hours.');
    }
}

// Example route to trigger the check
app.get('/sendEventReminders', (req, res) => {
    checkAndSendSMSForUpcomingEvents();
    res.send('Check for upcoming events initiated.');
});

const PORT = process.env.PORT || 3005;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
