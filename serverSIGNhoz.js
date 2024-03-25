require('dotenv').config();
const express = require('express');
const bodyParser = require('body-parser');
const twilio = require('twilio');
const cors = require('cors');
const app = express();
app.use(cors());
app.use(bodyParser.json());



const twilioClient = new twilio(process.env.TWILIO_ACCOUNT_SID, process.env.TWILIO_AUTH_TOKEN);


app.post('/signupForm', (req, res) => {
    const phoneNumber = req.body.phone;
    const verificationCode = Math.floor(100000 + Math.random() * 900000);

    twilioClient.messages.create({
        body: `Your verification code is: ${verificationCode}`,
        to: phoneNumber, // Text this number
        from: process.env.TWILIO_PHONE_NUMBER // From a valid Twilio number
    })
    .then(message => {
        console.log(message.sid);
        res.json({ success: true, message: 'Verification code sent!' });
    })
    .catch(error => {
        console.error(error);
        res.status(500).json({ success: false, error: error.message });
    });
});

const PORT = 3001;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
