require('dotenv').config();
const express = require('express');
const bodyParser = require('body-parser');
const twilio = require('twilio');
const cors = require('cors');
const app = express();
app.use(cors());
app.use(bodyParser.json());



const twilioClient = new twilio('AC3ac89a780083b70ff78362038796e9d7', 'edd8da305f965427994391ba3b001537');


app.post('/signupForm', (req, res) => {
    const phoneNumber = req.body.phone;
    const verificationCode = Math.floor(100000 + Math.random() * 900000); // Generate a 6-digit random number

    twilioClient.messages.create({
        body: `Your verification code is: ${verificationCode}`,
        to: phoneNumber, // Text this number
        from: '+447449615948' // From a valid Twilio number
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
