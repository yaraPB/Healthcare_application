const mongoose = require('mongoose');

const DoctorSchema = mongoose.Schema({
    Fname: {
        type: String,
        required: [true, "Please enter your first name"],

    },
    
    Lname: {
        type: String,
        required: [true, "Please enter your family name"],

    },

    age: {
        type: Number,
        required: [true, "Please enter your age"],
        default: 18
    },
    Salary: {
        type: Number,
        required: true,
        default: 18
    },
    Specilization: {
        type: String,
        required: false,
    },
 },

//  This is going to allow us to say when we last created this 
// and when we last updated it
{
    Timestamp: true
}
);

const Doctor = mongoose.model("Doctor", DoctorSchema);
module.exports = Doctor;