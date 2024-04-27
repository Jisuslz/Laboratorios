import mysql from 'mysql';

export default class CiudadesModel {
  constructor() {
    this.connection = mysql.createConnection({
      host: "localhost",
      user: "root",
      password: "",
      database: "aeropuerto",
    });
  }

  connect() {
    this.connection.connect();
  }

  closeConnection() {
    this.connection.end();
  }

  async getAllCiudades(ciudadId, country) {
    const query = 'SELECT id, codigo, nombre FROM aeropuertos';
    try {
      const results = await new Promise((resolve, reject) => {
        this.connection.query(query, (error, results) => {
          if (error) {
            reject(error);
          } else {
            resolve(results);
          }
        });
      });
      return results;
    } catch (error) {
      throw error;
    }
  }
}
