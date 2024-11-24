import React, { useState } from 'react';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import 'bootstrap/dist/css/bootstrap.min.css';
import Admin from './Admin';
import { parsePhoneNumberFromString, isValidPhoneNumber } from 'libphonenumber-js';
import PhoneInput from 'react-phone-input-2'; 
import 'react-phone-input-2/lib/style.css'; 
import './PhoneDeco.css'


function RegisterForm() {
  const [showAdmin, setShowAdmin] = useState(false);
  const [phoneNumber, setPhoneNumber] = useState('');
  const [formattedPhoneNumber, setFormattedPhoneNumber] = useState('');

  const countryCode = '+1'; 

  const handlePhoneNumberChange = (value) => {
  
    const phoneNumberObj = parsePhoneNumberFromString(value, 'US'); 
    if (phoneNumberObj && isValidPhoneNumber(value, 'US')) {
      setFormattedPhoneNumber(phoneNumberObj.formatInternational());
    } else {
      setFormattedPhoneNumber(value); 
    }
    setPhoneNumber(value); 
  };

  return (
    <div
      className="d-flex vh-100"
      style={{
        backgroundColor: '#121212',
        color: '#FFFFFF',
        paddingTop: '3rem',
        paddingBottom: '3rem',
      }}
    >
      {/* Left Half: Form */}
      <div className="d-flex flex-column justify-content-center align-items-center w-50 p-4">
        {/* Form Content */}
        <Form style={{ maxWidth: '300px', margin: '0 auto' }}>
          <Form.Group className="mb-3" controlId="formBasicEmail">
            <Form.Label>Email address</Form.Label>
            <Form.Control
              type="email"
              placeholder="JohnDoe@gmail.com"
              style={{
                backgroundColor: '#555',
                color: '#FFF',
                border: '1.5px solid #444',
              }}
            />
            <Form.Text className="text-muted">
              <div style={{ color: '#FFF' }}>We'll never share your email with anyone else.</div>
            </Form.Text>
          </Form.Group>

          <Form.Group className="mb-3" controlId="formBasicPassword">
            <Form.Label>Password</Form.Label>
            <Form.Control
              type="password"
              placeholder="Password"
              style={{
                backgroundColor: '#555',
                color: '#FFF',
                border: '1px solid #444',
              }}
            />
          </Form.Group>

          <Form.Group className="mb-3" controlId="formBasicPhone">
            <Form.Label>Phone Number</Form.Label>
            {/* Use PhoneInput component */}
            <PhoneInput
              country={'us'} // Set the default country
              value={phoneNumber} // Bind the state value
              onChange={handlePhoneNumberChange} // Handle phone number change
              placeholder="Enter phone number"
              inputStyle={{
                backgroundColor: '#555',
                color: '#fff',
                border: '1.5px solid #444',
                width: '100%',
              }}
            />
            <div style={{ color: '#FFF', marginTop: '10px' }}>
              {/* {formattedPhoneNumber && <p>Formatted Number: {formattedPhoneNumber}</p>} */}
            </div>
          </Form.Group>

          <Button
            variant="primary"
            type="submit"
            style={{
              backgroundColor: '#24AE7C',
              border: 'none',
              padding: '10px 20px',
              fontWeight: 'bold',
            }}
          >
            Get Started
          </Button>
        </Form>

        {/* Footer Content */}
        <div className="d-flex justify-content-between align-items-center mt-4 w-100">
          {/* Admin Button */}
          <Button
            size="sm"
            style={{
              backgroundColor: '#121212',
              color: '#24AE7C',
              border: 'none',
              boxShadow: 'none',
              fontSize: '0.9rem',
              textDecoration: 'underline',
            }}
            onClick={() => setShowAdmin(!showAdmin)}
          >
            Admin
          </Button>
          {showAdmin && <Admin />}
          {/* PMS 2024 Text */}
          <div className="text-center flex-grow-1" style={{ color: '#888' }}>
            PMS 2024
          </div>
        </div>
      </div>

      {/* Right Half: Image */}
      <div
        className="d-flex justify-content-center align-items-center w-50"
        style={{
          top: 0
        }}
      >
        <video width="100%" height="100%" muted autoPlay loop>
          <source src="doc_login.mp4" type="video/mp4" />
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
  );
}

export default RegisterForm;
