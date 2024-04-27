const express = require('express');

const app = express();
// Middleware
app.use(express.json());

// Routes
app.get('/users', async (req, res) => {
    res.send(`<h1>Hola desde NODEJS</h1>`);
});

app.get('/calculadora/html', async (req, res) => {
    const numero1 = +req.query.n1;
    const numero2 = +req.query.n2;
    const suma = numero1 + numero2;
    res.send(`<h1>Hola desde NODEJS</h1> la suma es: ${suma}`);
});

app.get('/calculadora', async (req, res) => {
    const numero1 = +req.query.n1;
    const numero2 = +req.query.n2;
    const suma = numero1 + numero2;
    const respuesta = {
        suma:suma
    };

    res.json(respuesta);
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});