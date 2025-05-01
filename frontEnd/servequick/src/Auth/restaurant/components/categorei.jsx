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
const [showBackToTop, setShowBackToTop] = useState(false);

useEffect(() => {
  const handleScroll = () => {
    if (window.pageYOffset > 300) {
      setShowBackToTop(true);
    } else {
      setShowBackToTop(false);
    }
  };

  window.addEventListener('scroll', handleScroll);
  return () => window.removeEventListener('scroll', handleScroll);
}, []);
const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  };
  
  const fetchCategorie = async () => {
    try {
      const response = await axios.get(`http://localhost:8000/api/categories`);
      setCaegories(response.data);
    } catch (error) {
      console.error("Erreur lors de la récupération des catégories :", error);
    }
  };
  
  useEffect(() => {
    fetchCategorie();
  }, []);
  <section 
  className="py-12 bg-wood-800 text-white" 
  style={{ backgroundImage: "url('https://www.bestrestaurantsmaroc.com/public/images/image_rs/_head_format/cc1afa81868c6c2465eb1c51a1540769_527_head.jpg')", backgroundSize: 'cover', backgroundPosition: 'center' }}
>
  <div className="container mx-auto px-4 sm:px-6 lg:px-8">
    <div className="text-center">
      <h1 className="text-4xl font-bold mb-4">Nos Catégories</h1>
      <div className="w-20 h-1 bg-wood-400 mx-auto mb-6"></div>
      <p className="text-wood-200 max-w-2xl mx-auto">Découvrez notre sélection de plats français authentiques, préparés avec passion et des ingrédients frais de saison.</p>
    </div>
  </div>
</section>
<section className="py-16 bg-wood-50">
  <div className="container mx-auto px-4 sm:px-6 lg:px-8">
    {categories.map((category) => (
      <div key={category.id} className="mb-16">
        <div className={`flex flex-col ${category.reverse ? 'md:flex-row-reverse' : 'md:flex-row'} items-center bg-white rounded-xl shadow-lg overflow-hidden`}>
          <div className="md:w-1/3 h-64 md:h-auto">
            <img src={category.image} alt={category.mon_categorie} className="w-full h-full object-cover" />
          </div>
          <div className="md:w-2/3 p-8">
            <h2 className="text-3xl font-bold text-wood-800 mb-4 category-title">{category.mon_categorie}</h2>
            <div className="w-20 h-1 bg-wood-500 mb-6"></div>
            <p className="text-wood-700 mb-6">{category.description}</p>
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
              {category.plat.map((plat) => (
                <div className="flex items-center">
                  <i className=" bx-Vins text-wood-600 mr-2"></i>
                  <span className="text-wood-800">{plat.nom_plat}</span>
                </div>
              ))}
            </div>
            <a href="#" className="inline-block bg-wood-600 hover:bg-wood-700 text-white px-6 py-3 rounded-lg transition-colors btn-text">Voir les {category.mon_categorie}</a>
          </div>
        </div>
      </div>
    ))}
  </div>
</section>

<Footer />

};

export default BonAppetitCategories;
