const express = require('express')
const mysql = require('mysql')
const cors = require('cors')

const app = express()
app.use(express.json())
app.use(cors({
  origin: 'http://localhost:3000', // Allow requests from this origin
  credentials: true       
}))

const db = mysql.createConnection({
    host: "localhost",
    user:"",
    password:"",
    database: "testDB"
  });

  app.post('/', (req, res) =>{
    const sql = "SELECT * FROM PATIENT"
    db.query(sql, [req.body.email, req.body.password], (err, data) =>{
        if(err) return res.json("Login failed")
        if(data.length > 0){
          return res.json("Login success")
        } else{
          return res.json("No record")
        }
    })
  })

  app.listen(8081, ()=>{
    console.log("Listening...");
  })