import mysql from "mysql2";

// Create a connection pool to the database
const pool = mysql.createPool({
  host: "localhost",      // MySQL host (use your remote host for production)
  user: "root",           // Your MySQL username
  password: "Mohamed56@",           // Your MySQL password
  database: "DB56",  // Name of your MySQL database
});

const promisePool = pool.promise();  // Use the promise-based API

export const query = async (sql: string, values: any[]) => {
    try {
      console.log("Executing query:", sql);
      const [results] = await promisePool.query(sql, values);
      console.log("Query results:", results);
    return results;
  } catch (error) {
    throw new Error(`Error executing query: ${error}`);
  }
};
