fetch('../../php/pagesCreation.php', {
   method: 'GET'
})
.then(response => response.text())
.then(data => {
   document.getElementById('output').innerHTML = data;
   alert(data);
})
.catch(error => {
   alert(error);
});
