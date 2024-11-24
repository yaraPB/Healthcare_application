// the registration form linked to the database

import React, {useState, useEffect} from 'react'
import 'bootstrap/dist/css/bootstrap.min.css'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8081';
axios.defaults.withCredentials = true;

const RegisterForm = () => {
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')

    function handleSubmit(event){
        event.preventDefault();
        axios.post('', {email, password})
        .then(res => console.log(res))
        .catch(err => console.log(err))
    }

  return (
    <div className='d-flex justify-content-center align-items-center bg-primary' style={{height: '100vh'}}>
        <div className="p-3 bg-white w-25">
            <form onSubmit={handleSubmit}>
                <div className='mb-3'>
                    <label htmlFor="email">Email</label>
                    <input type="email" placeholder='Enter Email' className='form-control'
                    onChange={e => setEmail(e.target.value)}  />
                </div>
                <div className='mb-3'>
                    <label htmlFor="password">password</label>
                    <input type="password" placeholder='Enter password' className='form-control'
                     onChange={e => setPassword(e.target.value)} />
                </div>
                <button className='btn btn-success'>Login</button>
            </form>
        </div>
    </div>
  )
}

export default RegisterForm
