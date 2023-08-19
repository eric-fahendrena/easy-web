fetch('../../php/pagesCreation.php', {
   method: 'GET'
})
.then(response => response.text())
.then(data => {
   alert(data);
  // document.getElementById('output').innerHTML = data;
})
.catch(error => {
   alert(error);
});
