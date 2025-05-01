import React, { useEffect, useState, useRef } from "react";
import axios from "axios";
import { Link, useNavigate } from "react-router-dom";
import { FaChartLine, FaShoppingCart, FaStore } from "react-icons/fa";
import { MdRestaurantMenu } from "react-icons/md";
import { IoMdStats } from "react-icons/io";
import Chart from "react-apexcharts";
import BASE_URL from "../apiConfig";

const BonAppetitDashboard = () => {
    const navigate = useNavigate();
    const [menuOpen, setMenuOpen] = useState(false);
    const [user, setUser] = useState(null);
    const [stats, setStats] = useState(null);
    const [chartData, setChartData] = useState({ series: [], options: {} });
    const dropdownRef = useRef(null);
    useEffect(() => {
        const userData = JSON.parse(sessionStorage.getItem("user"));
        if (userData) {
          setUser(userData);
          fetchStats(userData.id);
        }
      }, []);
    
      useEffect(() => {
        const handleClickOutside = (event) => {
          if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
            setMenuOpen(false);
          }
        };
    
        document.addEventListener("mousedown", handleClickOutside);
        return () => {
          document.removeEventListener("mousedown", handleClickOutside);
        };
      }, []);
      const handleLogout = () => {
        sessionStorage.removeItem("user");
        navigate("/login");
      };
      const fetchStats = async (restaurantId) => {
        try {
          const response = await axios.get(`${BASE_URL}/restaurant-stats/${restaurantId}`);
          setStats(response.data);
          prepareChartData(response.data.monthly_orders);
        } catch (error) {
          console.error("Erreur lors de la récupération des statistiques :", error);
        }
      };
      const prepareChartData = (monthlyOrders) => {
        const months = Object.keys(monthlyOrders);
        const orders = Object.values(monthlyOrders);
    
        const chartOptions = {
          chart: { id: "orders-chart" },
          xaxis: { categories: months },
        };
    
        const chartSeries = [{ name: "Commandes", data: orders }];
    
        setChartData({ series: chartSeries, options: chartOptions });
      };
      return (
        <div className="min-h-screen bg-gray-100">
          <header className="bg-wood-800 text-white shadow-md py-4 px-6 flex justify-between items-center">
            <h1 className="text-2xl font-bold">Tableau de bord</h1>
            <div className="relative" ref={dropdownRef}>
              <button
                onClick={() => setMenuOpen(!menuOpen)}
                className="focus:outline-none"
              >
                {user?.name}
              </button>
              {menuOpen && (
                <div className="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                  <button onClick={handleLogout} className="block px-4 py-2 text-gray-800 hover:bg-gray-100 w-full text-left">
                    Déconnexion
                  </button>
                </div>
              )}
            </div>
          </header>
    