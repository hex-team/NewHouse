/********* Main Config *********/
const express = require('express')
const app     = express()
const path    = require("path");
const port    = process.env.PORT || 5000;

app.listen(port, ()=> {
  console.log('Site Is Running ... ' + port);
});

app.use("/public", express.static(__dirname + '/public'));

app.get('/', (req, res)=> {
  res.sendFile(path.join(__dirname+'/index.html'));
});

app.get('*', function(req, res){
  res.status(404).send('404');
});