const id = localStorage.getItem('id');
if (id) {
    document.getElementById('id-show').textContent = 'ID: '+ id;
} else {
    document.getElementById('id-show').textContent = 'ID not found !'; 
}