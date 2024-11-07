const express = require("express");
const Patient = require("../models/patient.model.js");
const router  = express.Router();
const {getPatients, getPatient, addPatient, updatePatient, deletePatient} = require("../controller/patient.controller.js");


router.get('/', getPatients);

router.get('/:id', getPatient);

router.post('/', addPatient);

router.put('/:id', updatePatient);

router.delete('/:id', deletePatient);

module.exports = router;