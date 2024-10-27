const Patient = require('../models/patient.model');


// app.get(...) to see these products
const getPatients = async (req, res)=>{
    try{
        const patients = await Patient.find({});
        res.status(200).json(patients);
        } catch (error){
            res.status(500).json({message: error.message});
        }   
}


// get a specific patient through their id
const getPatient = async (req, res)=>{
    try{
        // we deconstruct it
        const { id } = req.params;
        const patient = await Patient.findById(id);
        res.status(200).json(patient);
    
        } catch (error){
            res.status(500).json({message: error.message});
        }
}


// app.post(...) to add new members
 const addPatient = async (req, res) =>{
    try{
        const patient =  await Patient.create(req.body);
        res.status(200).json(patient);
    }catch(error){
        res.status(500).json({message: error.message})
    }
    // res.send("the patient API is working");
};

// update a patient records
const updatePatient =  async (req, res) => {
    try{
        const {id} = req.params;

       const patient = await Patient.findByIdAndUpdate(id, req.body);
       
       if(!patient){
        return res.status(404).json({message: "Patient not found"});
       }

       const updatedPatient = await Patient.findById(id);
       res.status(200).json(updatedPatient);

    } catch(error) {
        res.status(500).json({message: error.message});
    }
};


// Deleting a product
const deletePatient =  async (req, res) => {
    try{
        const {id} = req.params;

       const patient = await Patient.findByIdAndDelete(id);
       
       if(!patient){
        return res.status(404).json({message: "Patient not found"});
       }

       res.status(200).json({message: "Patient record deleted successfully"});

    } catch(error) {
        res.status(500).json({message: error.message});
    }
};



module.exports = {
    getPatients,
    getPatient,
    addPatient,
    updatePatient,
    deletePatient
}