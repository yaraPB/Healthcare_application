// command to install express: npm i express
const express = require('express')
const app = express()

  app.listen(3000, () =>{
    console.log('Server is running on port 3000');
    
  })