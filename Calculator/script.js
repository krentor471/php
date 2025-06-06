function appendToDisplay(value) {
    const display = document.getElementById('result');
    display.value += value;
}

function clearDisplay() {
    const display = document.getElementById('result');
    display.value = '';
}

function calculate() {
    const display = document.getElementById('result');
    const expression = display.value;

    fetch('calculator.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'expression=' + encodeURIComponent(expression)
    })
    .then(response => response.text())
    .then(result => {
        display.value = result;
    })
    .catch(error => {
        console.error('Error:', error);
        display.value = 'Error';
    });
}

// Remove the check for GET parameter on page load
// window.onload = function() {
//     const urlParams = new URLSearchParams(window.location.search);
//     const result = urlParams.get('result');
//     if (result !== null) {
//         document.getElementById('result').value = result;
//     }
// } 