import React from 'react'
import { useState, useEffect } from 'react'
import axios from 'axios'
import { Link } from 'react-router-dom';

const Books = () => {

  const [books, setBooks] = useState([]);

  useEffect(() => {
    const fetchAllBooks = async () => {
      try {
        const res = await axios.get("http://localhost:8800/books");
        setBooks(res.data);
      } catch (err) {
        console.log(err);
      }};
    fetchAllBooks(); }, []);

  console.log(books);

  return (
    <div>
      <h1>Lama Book shop</h1>
      <div className="books">
            {books.map((book) => (
        <div key={book.id} className="book"> {/* Use `book.id` as the unique key */}
            <img src={book.cover} alt={book.title} />
            <h2>{book.price}</h2>
            <p>{book.description}</p>
        </div>
        ))}
      </div>
      <button><Link to='./Add.jsx'>Add new book</Link></button>
    </div>
  )
}

export default Books
// to fetch all the data that we have from the library we do:
// npm i axios
