import React, { useState } from 'react';
import { Button, Form, Alert } from 'react-bootstrap';
import AdminForm from './AdminForm'; // Import your AdminForm component

const Admin = () => {
  const [code, setCode] = useState(['', '', '', '', '', '']); // Store each digit of the code
  const [message, setMessage] = useState('');
  const [isVerified, setIsVerified] = useState(false);
  
  const correctCode = '111111';

  const handleCodeChange = (e, index) => {
    const value = e.target.value;
    if (value.length === 1 && /^[0-9]$/.test(value)) {  // Ensure only a single digit is entered
      const updatedCode = [...code];
      updatedCode[index] = value;
      setCode(updatedCode);

      // Check if the code is complete and correct
      if (updatedCode.join('') === correctCode) {
        setMessage('Verification successful. You are accepted.');
        setIsVerified(true);
      } else {
        setMessage('');
      }
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (code.join('') !== correctCode) {
      setMessage('Invalid code. You are rejected.');
    }
  };

  if (isVerified) {
    return <AdminForm />;
  }

  return (
    <div className="container" 
    style={{ padding: '20px',
             border: "4px solid #FFF",
             borderRadius: '8px',
             backgroundColor: "#24AE7C",
             zIndex: 9999,
             width: "500px"
            
    }}>
      <h1>Please enter your verification code:</h1>

      <Form onSubmit={handleSubmit}>
        <div className="d-flex">
          {code.map((digit, index) => (
            <Form.Control
              key={index}
              type="text"
              maxLength="1"
              value={digit}
              onChange={(e) => handleCodeChange(e, index)}
              className="mx-2"
              style={{ width: '40px', textAlign: 'center' }}
            />
          ))}
        </div>

        <Button
          variant="success"
          type="submit"
          className="mt-3"
        >
          Verify
        </Button>
      </Form>

      {message && (
        <Alert
          variant={message.includes('Invalid') ? 'danger' : 'success'}
          className="mt-3"
        >
          {message}
        </Alert>
      )}
    </div>
  );
};

export default Admin;
