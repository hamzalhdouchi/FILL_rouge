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
    
    export default MobileSidebar;
  );
};

export default DashboardRestaurant;