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
);
