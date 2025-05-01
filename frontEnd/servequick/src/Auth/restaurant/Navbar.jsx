import React, { useState } from 'react';
import { Link } from 'react-router-dom';

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <nav className="bg-wood-800 text-white py-4">
      <div className="container mx-auto px-4 md:px-6 flex justify-between items-center">
        <Link to="/" className="text-2xl font-serif font-bold">GourmetTable</Link>
      </div>
    </nav>
  );
};

export default Navbar;
