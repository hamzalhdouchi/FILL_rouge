import React, { useState } from "react"
import { Mail, Phoner } from "lucide-react"

export default function Contact() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    subject: "",
    message: "",
  })

  const handleChange = (e) => {
    const { id, value } = e.target
    setFormData((prev) => ({ ...prev, [id]: value }))
  }

  const handleSubmit = (e) => {
    e.preventDefault()
    console.log("Contact form submitted:", formData)
  }
  return (
    <section id="contact" className="py-16 bg-white">
      <div className="container mx-auto px-4">
        <h2 className="text-3xl md:text-4xl font-serif font-bold text-center mb-12">Contactez-nous</h2>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div>
            <form className="bg-wood-50 p-8 rounded-lg shadow-md" onSubmit={handleSubmit}>
              <div className="mb-6">
                <label htmlFor="name" className="text-wood-700 font-medium mb-2 block">Nom</label>
                <input type="text" id="name" value={formData.name} onChange={handleChange} className="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-wood-500" />
              </div>

              <div className="mb-6">
                <label htmlFor="email" className="text-wood-700 font-medium mb-2 block">Email</label>
                <input type="email" id="email" value={formData.email} onChange={handleChange} className="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-wood-500" />
              </div>

              <div className="mb-6">
                <label htmlFor="subject" className="text-wood-700 font-medium mb-2 block">Sujet</label>
                <input type="text" id="subject" value={formData.subject} onChange={handleChange} className="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-wood-500" />
              </div>
              <div className="mb-6">
                <label htmlFor="message" className="text-wood-700 font-medium mb-2 block">Message</label>
                <textarea id="message" rows="5" value={formData.message} onChange={handleChange} className="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-wood-500" />
              </div>

              <button type="submit" className="w-full bg-wood-700 hover:bg-wood-800 text-white font-bold py-3 px-4 rounded-md transition duration-300">
                Envoyer le Message
              </button>
            </form>
          </div>
