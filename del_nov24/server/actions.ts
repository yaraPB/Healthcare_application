"use server"
import { connectDB } from "@/lib/mongodb";
import User from "@/models/User";
import bcrypt from "bcryptjs";
import { parseStringify } from "./utils";
import { query } from '@/lib/MySQL/db';

export const register = async (values: any) => {
    const { email, password, name, phone } = values;

    try {
        await connectDB();
        const userFound = await User.findOne({ email });
        if(userFound){
            return {
                error: 'Email already exists!'
            }
        }
        const hashedPassword = await bcrypt.hash(password, 10);
        const user = new User({
          name,
          email,
          password: hashedPassword,
          phone
        });
        const savedUser = await user.save();
        //console.log("User created with ID:", savedUser);

        return  savedUser._id.toString();

    }catch(e){
        console.log(e);
    }
}

export const getUser = async (userId: string) => {
    try {
        await connectDB();
        const user = await User.findById(userId);
        return parseStringify(user);
    } catch (e) {
        console.log(e);
    }
}

export const getAllPatientUserIds = async () => {
    try {
        console.log("Fetching patient userIds...");
      // Query to get all userIds from the patients table
      const sql = 'SELECT * FROM patient';
        const results = await query(sql, []);
        return results;
        

      
      // Log all userIds to the console
      console.log("Patient UserIds:", results);
    } catch (error) {
        return error;
      console.error("Error fetching patient userIds:", error);
    }
  };