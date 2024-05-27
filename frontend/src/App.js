import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Navbar from './components/navbar/Navbar';
import Footer from './components/footer/Footer';
import Home from './pages/home/Home';
import AboutUs from './pages/aboutUs/AboutUs';
import Brands from './pages/brands/Brands';
import NotFound from './pages/notFound/NotFound';

const App = () => {
  return (
    <BrowserRouter basename={process.env.PUBLIC_URL}>

      <Navbar />

      <Routes>
          <Route index element={<Home/>} />
          <Route path='/about-us' element={<AboutUs/>} />
          <Route path='/brands' element={<Brands/>} />
          <Route path='*' element={<NotFound/>} />
      </Routes>

      <Footer />

    </BrowserRouter>
  )
}

export default App