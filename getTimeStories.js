const axios = require('axios'); 
const cheerio = require('cheerio');

var express = require('express');
var app     = express();

const url = 'https://time.com'; 

app.get('/getTimeStories',function (req,res) {
    
    axios.get(url).then(({ data }) => { 
		const $ = cheerio.load(data); // Initialize cheerio
		const output = [];
		$( ".latest-stories__item" ).each( (i, item ) => {
			let $a = $(item).find( 'a' );
			let datum = {
				title: $(item).find('.latest-stories__item-headline').text(),
				link: url.concat($a.attr( 'href' ))
			};
			output.push(datum);
		});
		console.log(output);
		const obj = JSON.stringify(output)
		res.send(obj)
	});
})
app.listen(8080,() => {
    console.log("http://localhost:8080/getTimeStories");
})



 
