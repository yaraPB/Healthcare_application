import { z } from "zod";


export const UserFormValidation = z.object({
    name: z.string()
        .min(2, "Name must be at least 2 characters.")
        .max(100, "Name must be at most 100 characters."),
    email: z.string().email("Invalid email address."),
    phone: z.string().refine((phone)=> /^\+?\d{1,3}[\s]?\d{9,12}$/.test(phone), "Invalid  number"),
    password: z.string().min(6, "Password must be at least 6 characters.")

})