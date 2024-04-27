import express, { json } from 'express';
import CiudadesController from './features/ciudades/api/v1/ciudades-controller.mjs';

const app = express();

// Middleware para devolver responses como JSON
app.use(json());

// Routes
const ciudadesApiController = new CiudadesController();
app.use('/api/', ciudadesApiController.getRouter());

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});