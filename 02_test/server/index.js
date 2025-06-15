import express from "express";
import mysql from "mysql";
import cors from 'cors';

const app = express();

app.use(express.json())
app.use(cors({ origin: "http://localhost:3000" }))

const db = mysql.createConnection({
    host: "localhost",
    user:"root",
    password:"",
    database: "app_library"
});


// if there is an authentification problem we write the following in MYSQL
//  ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'your password';
app.get("/", (req, res)=>{
    res.json("Hello this is the backend");
});

app.get("/books", (req, res)=>{
    const query = "SELECT * FROM BOOK";
    db.query(query, (err, data) =>{
        if(err) return res.json(err);
        return res.json(data);
    });
});

app.post("/books", (req, res)=>{
    const query = "INSERT INTO BOOK (TITLE, DESCRIPTION, COVER) VALUES (?)"
    const values = [ req.body.title, req.body.description, req.body.cover];
    db.query(query, [values], (err, data)=>{
        if(err) return res.json(err);
        return res.json(data);
    });
});

app.listen(8800, () => {
    console.log("Successfully connected to the backend!");
});

// to allow the link between the bakcend and the frontend:
// npm i cors
