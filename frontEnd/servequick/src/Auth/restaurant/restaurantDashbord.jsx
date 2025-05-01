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
    // Dans le JSX principal
<header className="bg-white shadow-md border-b border-wood-200 sticky top-0 z-10">
  <div className="flex justify-between items-center px-6 py-4">
    <div className="flex items-center space-x-3">
      <button className="md:hidden text-wood-600">
        <i className='bx bx-menu text-2xl'></i>
      </button>
      <h2 className="text-xl font-bold text-wood-800">Tableau de Bord Restaurant</h2>
    </div>
    
    <div className="flex items-center space-x-4">
      <div className="relative">
        <input
          type="text"
          placeholder="Rechercher..."
          className="pl-10 pr-4 py-2 rounded-lg border border-wood-200 focus:outline-none focus:ring-2 focus:ring-wood-500 focus:border-transparent"
        />
        <i className='bx bx-search absolute left-3 top-2.5 text-wood-400'></i>
      </div>
      
      <button className="relative p-2 text-wood-600 hover:bg-wood-100 rounded-full">
        <i className='bx bx-bell text-xl'></i>
        <span className="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
      </button>
      
      <div className="flex items-center space-x-2">
        <div className="w-10 h-10 rounded-full bg-wood-200 flex items-center justify-center">
          <i className='bx bx-user text-xl text-wood-600'></i>
        </div>
        <div className="hidden md:block">
          <p className="text-sm font-medium text-wood-800">Chef de Restaurant</p>
          <p className="text-xs text-wood-500">chef@bonappetit.com</p>
        </div>
      </div>
    </div>
  </div>
</header>
  );
};

export default DashboardRestaurant;