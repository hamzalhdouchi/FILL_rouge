import React, { useEffect, useState, useCallback, useMemo } from "react";
import axios from "axios";
import Swal from "sweetalert2";
import { Link } from "react-router-dom";
import HeaderDach from "./layout/headerDach";
import UserProfile from "../profiel";

const STATUS_OPTIONS = [
  { value: "", label: "Toutes les Commandes" },
  { value: "en_attente", label: "En attente" },
  { value: "en_cours", label: "En cours" },
  { value: "terminee", label: "Terminée" },
  { value: "annulee", label: "Annulée" }
];

const StatusBadge = ({ status }) => {
  const statusClasses = {
    en_attente: "bg-yellow-100 text-yellow-800",
    en_cours: "bg-blue-100 text-blue-800",
    terminee: "bg-green-100 text-green-800",
    annulee: "bg-red-100 text-red-800"
  };

  return (
    <span className={`px-2 inline-flex text-xs font-semibold rounded-full ${statusClasses[status] || "bg-gray-100 text-gray-800"}`}>
      {status.replace("_", " ")}
    </span>
  );
};

const StatCard = ({ title, value, icon, color, trend }) => (
  <div className="bg-white rounded-xl shadow-md p-6 border border-wood-100">
    <div className="flex items-center justify-between mb-4">
      <h4 className="font-medium text-wood-700">{title}</h4>
      <div className={`w-12 h-12 rounded-full bg-${color}-100 flex items-center justify-center`}>
        <i className={`${icon} text-2xl text-${color}-600`}></i>
      </div>
    </div>
    <p className="text-3xl font-bold text-wood-900 mb-1">{value}</p>
    <div className="flex items-center text-sm">
      <span className="text-green-500 flex items-center">
        <i className='bx bx-up-arrow-alt'></i> {trend}
      </span>
      <span className="text-wood-500 ml-2">Depuis le mois dernier</span>
    </div>
  </div>
  const CommandDash = () => {
    const [commandes, setCommandes] = useState([]);
    const [loading, setLoading] = useState(true);
    const [search, setSearch] = useState("");
    const [filtreStatut, setFiltreStatut] = useState("");
    const [showStatusModal, setShowStatusModal] = useState(false);
    const [selectedCommande, setSelectedCommande] = useState(null);
    const [newStatut, setNewStatut] = useState("");
    const [stats, setStats] = useState({
      totalPrixCommandes: 0,
      totalCommandes: 0,
      totalReservations: 0,
      totalPlats: 0
    });
    const [showProfile, setShowProfile] = useState(false);
    const [user, setUser] = useState(null);
  
    const restaurant = useMemo(() => {
      return JSON.parse(sessionStorage.getItem('restaurant')) || {};
    }, []);
    const fetchCommandes = useCallback(async () => {
        setLoading(true);
        try {
          const response = await axios.get(`http://localhost:8000/api/commandes/restaurant/${restaurant.id}`);
          setCommandes(response.data.data);
        } catch (error) {
          console.error("Erreur lors du chargement des commandes :", error);
          Swal.fire("Erreur", "Impossible de charger les commandes", "error");
        } finally {
          setLoading(false);
        }
      }, [restaurant.id]);
    
      const fetchStats = useCallback(async () => {
        try {
          const menu = JSON.parse(sessionStorage.getItem('menu')) || [];
          const menu_id = menu[0]?.id;
    
          const [totPxRes, totCRes, totRes, totPlat] = await Promise.all([
            axios.get(`http://localhost:8000/api/statistiques/total-prix-commandes/${restaurant.id}`),
            axios.get(`http://localhost:8000/api/statistiques/commandes/${restaurant.id}`),
            axios.get(`http://localhost:8000/api/statistiques/total-reservations/${restaurant.id}`),
            menu_id ? axios.get(`http://localhost:8000/api/statistiques/total-plat/${menu_id}`) : { data: 0 }
          ]);
    
          setStats({
            totalPrixCommandes: totPxRes.data.total_prix_commandes,
            totalCommandes: totCRes.data.total,
            totalReservations: totRes.data.total_reservations,
            totalPlats: totPlat.data.total
          });
        } catch (error) {
          console.error("Erreur lors de la récupération des statistiques:", error);
        }
      }, [restaurant.id]);
    
);
