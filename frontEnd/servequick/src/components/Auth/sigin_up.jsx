import React, { useState } from "react";

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

<button type="submit">S'inscrire</button>
      </div>
    </div>
  );
};

export default Register;
