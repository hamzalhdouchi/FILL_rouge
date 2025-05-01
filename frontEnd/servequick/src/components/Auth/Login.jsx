import { useState } from "react";
import axios from "axios";
import Swal from "sweetalert2";

const Login = ({ isLoading, setIsLoading }) => {

    const message = sessionStorage.getItem("message") ;
  if(message){
    Swal.fire({
      icon: "error",
      title: message,
      text: "Veuillez vous connecter à votre compte",
      timer: 2000,
      showConfirmButton: false,
    });
    sessionStorage.removeItem("message");
  }

  const [formData, setFormData] = useState({
    email: "",
    password: "",
  });


  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleLogin = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      const response = await axios.post("http://localhost:8000/api/login", formData);

      if (response.status === 200) {
        const { token, user, message } = response.data;
        const role = user.role_id;
        const user_id = user.id;

        if (role === 2) {
            const restaurant = response.data.restaurant;
            const menu = response.data.restaurant.menu;
            sessionStorage.setItem("menu", JSON.stringify(menu));
            sessionStorage.setItem("restaurant",JSON.stringify(restaurant));
          }