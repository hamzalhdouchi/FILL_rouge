import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
const navigate = useNavigate();
import axios from "axios";
import Swal from "sweetalert2";
const Register = () => {
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        phone: "",
        address: "",
        role: "user",
        description: "",
        file: null,
    });
    const [errors, setErrors] = useState({});

    const [loading, setLoading] = useState(false);
    
    const handleChange = (e) => {
      setFormData({ ...formData, [e.target.name]: e.target.value });
    };
    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        try {
          const form = new FormData();
          Object.keys(formData).forEach((key) => {
            if (formData[key]) form.append(key, formData[key]);
          });
          await axios.post("/api/register", form);
          Swal.fire("Succès", "Inscription réussie !", "success");
          setFormData({
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            phone: "",
            address: "",
            role: "user",
            description: "",
            file: null,
          });
          navigate("/login");
        } catch (error) {
          if (error.response?.status === 422) {
            setErrors(error.response.data.errors);
          } else {
            Swal.fire("Erreur", "Une erreur est survenue.", "error");
          }
        } finally {
          setLoading(false);
        }
      };
    <button type="submit">S'inscrire</button>
    const handleFileChange = (e) => {
      setFormData({ ...formData, file: e.target.files[0] });
    };
    
    {errors.name && <p className="text-red-500 text-sm">{errors.name[0]}</p>}

    const handleRoleChange = (e) => {
      const role = e.target.value;
      setFormData({ ...formData, role });
    };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100">
      <div className="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <input type="text" name="name" placeholder="Nom" />
<input type="email" name="email" placeholder="Email" />
<input type="password" name="password" placeholder="Mot de passe" />
<input type="password" name="password_confirmation" placeholder="Confirmer mot de passe" />
<input type="text" name="phone" placeholder="Téléphone" />
<input type="text" name="address" placeholder="Adresse" />

<select name="role">
  <option value="user">Utilisateur</option>
  <option value="restaurateur">Restaurateur</option>
  <option value="livreur">Livreur</option>
</select>

{formData.role === "restaurateur" && (
  <textarea name="description" placeholder="Description du restaurant" />
)}

{formData.role === "restaurateur" && (
  <input type="file" name="file" />
)}


      </div>
    </div>
  );
};

export default Register;
