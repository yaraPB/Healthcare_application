import './App.css';
import {BrowserRouter as Router,Routes, Route} from "react-router-dom";
import RegisterForm from './Components/RegisterForm';

function App() {
  return (
    <div className="App">
      <RegisterForm/>
    </div>
  );
}

export default App;
