console.log( 'start....' );

document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var formData = new FormData();
    formData.append('file', document.getElementById('file').files[0]);

    console.log( formData );

    fetch('process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('results').innerHTML = data.message;
    })
    .catch(error => {
        console.error('Error:', error);
    });
});