// DashboardRestaurant.js
import { useEffect } from 'react';
import { Chart } from 'chart.js/auto';

const DashboardRestaurant = () => {
  useEffect(() => {
    // Initialisation des graphiques (à implémenter plus tard)
  }, []);
// Ajout dans DashboardRestaurant.js
useEffect(() => {
    // Gestion de la sidebar mobile
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const mobileSidebarContent = document.getElementById('mobile-sidebar-content');
    const closeSidebar = document.getElementById('close-sidebar');
    
    sidebarToggle.addEventListener('click', () => {
      mobileSidebar.classList.remove('hidden');
      setTimeout(() => {
        mobileSidebarContent.classList.remove('-translate-x-full');
      }, 10);
    });
    
    closeSidebar.addEventListener('click', () => {
      mobileSidebarContent.classList.add('-translate-x-full');
      setTimeout(() => {
        mobileSidebar.classList.add('hidden');
      }, 300);
    });
  }, []);
  
  // Ajout dans le JSX
  <>
    {/* Bouton toggle mobile */}
    <div className="fixed bottom-4 right-4 md:hidden z-20">
      <button id="sidebar-toggle" className="bg-wood-700 text-white p-3 rounded-full shadow-lg">
        <i className='bx bx-menu text-2xl'></i>
      </button>
    </div>
    
    {/* Sidebar Mobile */}
    <div id="mobile-sidebar" className="fixed inset-0 bg-black bg-opacity-50 z-30 hidden">
      <div className="bg-wood-800 text-white w-64 h-full overflow-y-auto transform transition-transform duration-300 -translate-x-full" id="mobile-sidebar-content">
        {/* Contenu du menu mobile */}
      </div>
    </div>
  </>
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
  );
};

export default DashboardRestaurant;