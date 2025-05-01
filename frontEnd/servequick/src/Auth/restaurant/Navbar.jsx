import React, { useState } from 'react';
import { Link } from 'react-router-dom';

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <nav className="bg-wood-800 text-white py-4">
      <div className="container mx-auto px-4 md:px-6 flex justify-between items-center">
        <Link to="/" className="text-2xl font-serif font-bold">GourmetTable</Link>
        
        <div className="hidden md:flex space-x-6">
          <Link to="/restaurants" className="hover:text-wood-100 transition">Restaurants</Link>
          <Link to="/about" className="hover:text-wood-100 transition">À propos</Link>
          <Link to="/reservation" className="hover:text-wood-100 transition">Réservation</Link>
          <Link to="/reviews" className="hover:text-wood-100 transition">Avis</Link>
          <Link to="/contact" className="hover:text-wood-100 transition">Contact</Link>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
