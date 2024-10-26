// after installing express we do the following to import it
const express = require('express');
const mongoose = require('mongoose');
const Patient = require('./models/patient.model.js')
const app = express();

// req = what client send into the server
// res = what client gets form the server

app.get('/', (req, res) => {
    res.send("A whole new message");
});

app.post('/api/patients', async (req, res) =>{
    try{
        const patient =  await Patient.create(req.body);
        res.status(200).json(product);
    }catch(error){
        res.status(500).json({message: error.message})
    }
    // res.send("the patient API is working");
});

// you always have to refresh when you make new changes
// to get rid of that we do the following command:
// npm i nodemon -D

// to use mongodb we do the following: npm i mongoose
mongoose.connect("mongodb+srv://yarakouttane234:gauX4OyzWFNL3p8L@mongodb.x6fp0.mongodb.net/?retryWrites=true&w=majority&appName=MongoDB")
.then(() =>{
    console.log("Connected to the database!");
    app.listen(3000, () =>{
        console.log("Server is running on port 3000");  
    })
})
.catch( ()=>{
    console.log("Connection failed");
});

// we're going to store our info in basically models that our application can use