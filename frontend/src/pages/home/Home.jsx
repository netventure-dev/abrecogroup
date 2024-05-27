import React from 'react';
import AnimatedComponent from '../../components/AnimatedComponent';

import Banner from "../../images/happy-woman.webp";
import Dots from "../../images/dots-3.webp";

import HomeSlider from '../../components/homeSlider/HomeSlider';
import Brands from '../../components/brands/Brands';
import Join from '../../components/join/Join';
import Timeline from '../../components/timeline/Timeline';
import Ceo from '../../components/ceo/Ceo';
import News from '../../components/news/News';
import LifeAt from '../../components/lifeat/LifeAt';
import Clients from '../../components/clients/Clients';
import Locations from '../../components/locations/Locations';

const Home = () => {
  return (
    <>

      <HomeSlider />

      <section className='pageSubTitle'>
        <div className='container'>
          <div className='data'>
            <AnimatedComponent id="dot-1" animation="animate__fadeInUp">
              <img src={Dots} alt="" />
            </AnimatedComponent>
            <AnimatedComponent animation="animate__fadeInUp">
              <h2>A Multi-faceted business conglomerate headquartered in the UAE with operations in over <span>twenty countries</span> and a workforce of over 3,000 people.</h2>
              <p>Abreco Group’s diverse global teams bring in deep industry and functional expertise, successfully operating in Freight, Transport, Removals, Energy, Oil & Gas, Banking, Forex, Retail, Hospitality, Distribution, Education, and more.</p>
            </AnimatedComponent>
          </div>
        </div>
      </section>

      <section className='pageSubTitleWithBanner'>
        <div className='container' style={{
          backgroundImage: `url(${Banner})`,
        }}>
          <div className='data'>
            <AnimatedComponent animation="animate__fadeInUp">
              <h2>Changing Lives <br />through Inclusive Support</h2>
            </AnimatedComponent>
          </div>
        </div>
      </section>

      <section className='pageSubTitle pt-0'>
        <div className='container'>
          <div className='data'>
            <AnimatedComponent id="dot-2" animation="animate__fadeInUp">
              <img src={Dots} alt="" />
            </AnimatedComponent>
            <AnimatedComponent animation="animate__fadeInUp">
              <p>Doing business for good is as important to us as doing good business. Rise for Good is the creative expression of our desire to drive positive change among our stakeholders, in the community, and in the world.</p>
            </AnimatedComponent>
          </div>
        </div>
      </section>

      <AnimatedComponent animation="animate__fadeInUp">
        <Brands />
      </AnimatedComponent>

      <Join />

      <AnimatedComponent animation="animate__fadeInUp">
        <Timeline />
      </AnimatedComponent>

      <Ceo />

      <News />

      <LifeAt />

      <Clients />

      <AnimatedComponent animation="animate__fadeInUp">
        <Locations />
      </AnimatedComponent>

    </>
  )
}

export default Home