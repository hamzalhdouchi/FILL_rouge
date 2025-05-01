import { useState } from "react";
import Login from "../auth/login";
import Register from "../auth/sigin_up";

const AuthPage = () => {
  const [activeTab, setActiveTab] = useState("login");
  const [isLoading, setIsLoading] = useState(false);

  return (
    <div className="bg-gradient-to-br from-wood-100 to-white min-h-screen">
      <div className="min-h-screen flex flex-col md:flex-row">
        
        <div className="hidden lg:block lg:w-1/2 relative">
          <div className="absolute inset-0 bg-gradient-to-r from-wood-900/70 to-wood-800/50 z-10"></div>
          <img
            src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
            alt="Restaurant interior"
            className="absolute inset-0 w-full h-full object-cover"
          />
          <div className="relative z-20 h-full flex flex-col justify-center items-center p-12 text-white">
            <div className="mb-8 text-center">
              <h1 className="text-5xl font-bold mb-4 tracking-tight">Serve Quick</h1>
              <p className="text-xl max-w-md text-wood-100/90">
                Welcome to our culinary experience. Sign in to explore our menu and make reservations.
              </p>
            </div>
            <div className="mt-8 flex space-x-4">
              <span className="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm">Fine Dining</span>
              <span className="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm">Reservations</span>
              <span className="px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm">Delivery</span>
            </div>
          </div>
        </div>
