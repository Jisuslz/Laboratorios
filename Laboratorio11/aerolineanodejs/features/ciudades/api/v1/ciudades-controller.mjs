import express from "express";
import CiudadesModel from "../../ciudades-model.mjs";

const { Router } = express;

export default class CiudadesController {
  #router = Router();
  #ciudadesModel = null;
  
  constructor() {
    this.registerRoutes();
  }
  
  getRouter() {
    return this.#router;
  }
  
  registerRoutes() {
    const routerV1 = Router();
    routerV1.get(`/ciudades`, async (req, res) => await this.getAllCiudades(req, res));
    
    this.#router.use(`/v1`, routerV1);
  }
  
  async getAllCiudades(req, res) {
    try {
      this.#ciudadesModel = new CiudadesModel();
      this.#ciudadesModel.connect();
      const ciudades = await this.#ciudadesModel.getAllCiudades();
      res.json(ciudades);
    } catch (error) {
      console.error(`error: ${error}`);
    } finally {
      this.#ciudadesModel.closeConnection();
    }
  }
}
