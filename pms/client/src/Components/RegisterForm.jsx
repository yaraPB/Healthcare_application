import React, {useState} from 'react'
import "./assets/RegisterForm.css"

const RegisterForm = () => {

    const [action, setAction] = useState('Sign up');

  return (
    <div className='container'>
    <div className="header">
        <div className="text">{action}</div>
                <form>

                    <div className="input" name='Name'>Name: <input type="text" /></div>
                    <div className="input">Email: <input type="email" /></div>
                    <div className="input">Password: <input type="password" /></div>
                
                </form>
    </div> 
    <div className='submit-container'>
       <div className={action === "Login" ? "submit": "submit"}>Sign up</div>
       <div className="">Register</div>
        </div>
</div>
  )
}

export default RegisterForm
