fetch('../../php/pagesCreation.php', {
   method: 'GET'
})
.then(response => response.text())
.then(data => {
   alert(data);
})
.catch(error => {
   alert(error);
});