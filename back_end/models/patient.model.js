const mongoose = require('mongoose');

const PatientSchema = mongoose.Schema({
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
 },

//  This is going to allow us to say when we last created this 
// and when we last updated it
{
    timestamps: true
});

const Patient = mongoose.model("Patient", PatientSchema);
module.exports = Patient;
