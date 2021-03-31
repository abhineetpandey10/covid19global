<html>
<div id="data"></data>
<script>
var dataArray=[];
fetch("https://coronavirus-map.p.rapidapi.com/v1/spots/summary", {
	"method": "GET",
	"headers": {
		"x-rapidapi-key": "0eaa1eb6a3msh3ea1868fce9482fp11c5e7jsnc4c99dec597a",
		"x-rapidapi-host": "coronavirus-map.p.rapidapi.com"
	}
})
.then(response => response.json())
.then(data=>
        {
            //console.log(data.data);
            for (x in data.data) 
            {
                dataArray.push(data.data[x]["total_cases"])
            }
            console.log(dataArray);
            console.log(JSON.stringify(data.data["2021-03-26"]["total_cases"]));
        })
.catch(err => {
	console.error(err);
});
</script>
</html>