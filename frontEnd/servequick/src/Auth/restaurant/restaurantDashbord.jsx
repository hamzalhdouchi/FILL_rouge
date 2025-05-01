// DashboardRestaurant.js
import { useEffect } from 'react';
import { Chart } from 'chart.js/auto';

const DashboardRestaurant = () => {
  useEffect(() => {
    // Initialisation des graphiques (à implémenter plus tard)
  }, []);
  const Sidebar = () => (
    <aside className="w-64 bg-wood-800 text-white fixed h-full z-10 hidden md:block">
      <div className="p-4 border-b border-wood-700">
        <div className="flex items-center space-x-3">
          <div className="w-10 h-10 rounded-full bg-wood-600 flex items-center justify-center">
            <i className='bx bx-restaurant text-xl'></i>
          </div>
          <h1 className="font-bold text-lg">Serve Quick</h1>
        </div>
      </div>
      
      <nav className="mt-6">
        {/* Items de menu */}
      </nav>
      
      <div className="absolute bottom-0 w-full p-4 border-t border-wood-700">
        <button className="flex items-center text-wood-300 hover:text-white">
          <i className='bx bx-log-out text-xl mr-3'></i>
          <span>Déconnexion</span>
        </button>
      </div>
    </aside>
  );
  
  return (
    <div className="bg-wood-50">
      <div className="min-h-screen flex">
        {/* Sidebar Desktop */}
        <aside className="w-64 bg-wood-800 text-white fixed h-full z-10 hidden md:block">
          <div className="p-4 border-b border-wood-700">
            <div className="flex items-center space-x-3">
              <div className="w-10 h-10 rounded-full bg-wood-600 flex items-center justify-center">
                <i className='bx bx-restaurant text-xl'></i>
              </div>
              <div>
                <h1 className="font-bold text-lg brand-text">Serve Quick</h1>
                <p className="text-xs text-wood-300">Gestion Restaurant</p>
              </div>
            </div>
          </div>
          
          <nav className="mt-6">
            {/* Menu items */}
          </nav>
          
          <div className="absolute bottom-0 w-full p-4 border-t border-wood-700">
            <a href="#logout" className="flex items-center text-wood-300 hover:text-white">
              <i className='bx bx-log-out text-xl mr-3'></i>
              <span>Déconnexion</span>
            </a>
          </div>
        </aside>
        
        {/* Contenu principal */}
        <div className="flex-1 md:ml-64">
          {/* Header et contenu ira ici */}
        </div>
      </div>
    </div>
    import { useState } from 'react';

    const MobileSidebar = () => {
      const [isOpen, setIsOpen] = useState(false);
    
      return (
        <>
          <button 
            onClick={() => setIsOpen(true)}
            className="fixed bottom-4 right-4 md:hidden z-20 bg-wood-700 text-white p-3 rounded-full shadow-lg"
          >
            <i className='bx bx-menu text-2xl'></i>
          </button>
          
          {isOpen && (
            <div className="fixed inset-0 bg-black bg-opacity-50 z-30">
              <div className={`bg-wood-800 text-white w-64 h-full transform transition-transform duration-300 ${isOpen ? 'translate-x-0' : '-translate-x-full'}`}>
                {/* Contenu du menu mobile */}
                <button 
                  onClick={() => setIsOpen(false)}
                  className="absolute top-4 right-4 text-wood-300 hover:text-white"
                >
                  <i className='bx bx-x text-2xl'></i>
                </button>
              </div>
            </div>
          )}
        </>
      );
    };
    // Dans le main content
<section className="mb-8">
  <h3 className="text-xl font-bold text-wood-800 mb-4">Aperçu</h3>
  
  <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    {/* Carte Commandes */}
    <div className="bg-white rounded-xl shadow-md p-6 border border-wood-100">
      <div className="flex items-center justify-between mb-4">
        <h4 className="font-medium text-wood-700">Commandes Totales</h4>
        <div className="w-12 h-12 rounded-full bg-olive-100 flex items-center justify-center">
          <i className='bx bxs-receipt text-2xl text-olive-600'></i>
        </div>
      </div>
      <p className="text-3xl font-bold text-wood-900 mb-1">1,248</p>
      <div className="flex items-center text-sm">
        <span className="text-green-500 flex items-center">
          <i className='bx bx-up-arrow-alt'></i> 15.3%
        </span>
        <span className="text-wood-500 ml-2">Depuis le mois dernier</span>
      </div>
    </div>
    
    {/* 3 autres cartes similaires */}
  </div>
</section>
const Header = () => (
    <header className="bg-white shadow-md border-b border-wood-200 sticky top-0 z-10">
      <div className="flex justify-between items-center px-6 py-4">
        <div className="flex items-center space-x-3">
          <h2 className="text-xl font-bold text-wood-800">Tableau de Bord</h2>
        </div>
        
        <div className="flex items-center space-x-4">
          <div className="relative">
            <input
              type="text"
              placeholder="Rechercher..."
              className="pl-10 pr-4 py-2 rounded-lg border border-wood-200 focus:outline-none focus:ring-2 focus:ring-wood-500"
            />
            <i className='bx bx-search absolute left-3 top-2.5 text-wood-400'></i>
          </div>
          
          {/* Notifications et profil */}
        </div>
      </div>
    </header>
  );
  
  );
  // CommandDash.js
import React from 'react';

const CommandDash = () => {
  return (
    <section id="commandes" className="mb-8">
      <div className="flex justify-between items-center mb-4">
        <h3 className="text-xl font-bold text-wood-800">Gestion des Commandes</h3>
        <button className="bg-wood-600 hover:bg-wood-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i className='bx bx-plus mr-2'></i> Nouvelle Commande
        </button>
      </div>
      
      <div className="bg-white rounded-xl shadow-md border border-wood-100 overflow-hidden">
        {/* Contenu des commandes */}
      </div>
    </section>
  );
};

const Footer = () => (
    <footer className="bg-white border-t border-wood-200 py-4 px-6 text-center text-wood-600 text-sm">
      <p>© 2025 Serve Quick. Tous droits réservés.</p>
    </footer>
  );
  
  export default Footer;};

export default DashboardRestaurant;