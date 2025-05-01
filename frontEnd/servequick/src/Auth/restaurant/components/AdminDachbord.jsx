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
    