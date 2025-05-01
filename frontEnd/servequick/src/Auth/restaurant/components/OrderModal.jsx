import React from 'react';

const OrderModal = ({ 
  showModal, 
  closeModal, 
  currentplate
}) => {
  if (!showModal || !currentplate) return null;

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
      <div className="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 overflow-hidden modal-enter">
        <div className="bg-wood-700 text-white py-4 px-6">
          <div className="flex justify-between items-center">
            <h3 className="text-xl font-serif">Réserver un Plat</h3>
            <button onClick={closeModal} className="text-white hover:text-wood-200 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
        <div className="p-6">
          <div className="mb-6">
            <h4 className="text-xl font-serif mb-2">{currentplate.nom_plat}</h4>
            <p className="text-wood-600 mb-1">{currentplate.category}</p>
            <p className="text-lg font-semibold text-wood-700">{currentplate.prix}€</p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default OrderModal;
