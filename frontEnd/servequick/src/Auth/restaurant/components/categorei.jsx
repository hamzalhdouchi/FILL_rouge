import React, { useState, useEffect } from 'react';
import axios from 'axios';
import 'boxicons/css/boxicons.min.css';
import Footer from './components/footer';

const BonAppetitCategories = () => {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [showBackToTop, setShowBackToTop] = useState(false);
  const [categories, setCaegories] = useState([]);
  
  const token = localStorage.getItem('token');
  if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  }
  
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

// Dans le JSX
<button 
  id="mobile-menu-button" 
  className="md:hidden text-wood-800"
  onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
>
  <i className='bx bx-menu text-2xl'></i>
</button>

};

export default BonAppetitCategories;
