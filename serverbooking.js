require('dotenv').config();
const express = require('express');
const bodyParser = require('body-parser');
const twilio = require('twilio');
const cors = require('cors');

const app = express();
app.use(bodyParser.json());
app.use(cors());

const twilioClient = new twilio('', '');

app.post('/bookEvent', (req, res) => {
    const { phone, eventName } = req.body;
    const confirmationMessage = `Your booking for the event has been confirmed!`;

    twilioClient.messages.create({
        body: confirmationMessage,
        to: phone,
        from: '+447449615948'
    })
    .then(message => {
        console.log(`Message sent with SID: ${message.sid}`);
        res.json({ success: true, message: 'Booking confirmed and message sent!' });
    })
    .catch(error => {
        console.error(error);
        res.status(500).json({ success: false, error: error.message });
    });
});


const PORT = 3002;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
