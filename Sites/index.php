<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Biblioteca Delivery </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre los delivery.</p>

  <br>

  <div align="center" class="search">
  <h3 align="center"> ¿Quieres mostrar todas las direcciones?</h3>

  <form align="center" action="consultas/consulta_1.php" method="post">
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>
  </div>

  <div align="center" class="search"> 
  <h3 align="center"> ¿Quieres buscar los vehículos de las unidades ubicadas en una comuna?</h3>

  <form align="center" action="consultas/consulta_2.php" method="post">
    Comuna:
    <input type="text" name="comuna">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>
  </div>

  <div align="center" class="search">
  <h3 align="center"> ¿Quieres buscar los vehículos que realizaron un despacho a una comuna durante un año?</h3>

  <form align="center" action="consultas/consulta_3.php" method="post">
    Comuna:
    <input type="text" name="comuna">
    <br/><br/>
    Año:
    <label for="type"></label>
    <select name="año" id="type">
      <option value="2022">2022</option>
      <option value="2021">2021</option>
    </select>
    <br/><br/>    
    <input type="submit" value="Buscar">
  </form>
  </div>

  <div align="center" class="search">
  <h3 align="center"> ¿Quieres buscar los despachos que se realizaron por un tipo de vehículo y cuyo repartidor esté en un rango de edad?</h3>

  <form align="center" action="consultas/consulta_4.php" method="post">
    Tipo de vehículo:
    <input type="text" name="licencia">
    <br/><br/>
    Edad (desde):
    <label for="type"></label>
    <select name="Desde" id="type">
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
      <option value="32">32</option>
      <option value="33">33</option>
      <option value="34">34</option>
      <option value="35">35</option>
      <option value="36">36</option>
      <option value="37">37</option>
      <option value="38">38</option>
      <option value="39">39</option>
      <option value="40">40</option>
      <option value="41">41</option>
      <option value="42">42</option>
      <option value="43">43</option>
      <option value="44">44</option>
      <option value="45">45</option>
      <option value="46">46</option>
      <option value="47">47</option>
      <option value="48">48</option>
      <option value="49">49</option>  
      <option value="50">50</option>  
      <option value="51">51</option>
      <option value="52">52</option>
      <option value="53">53</option>
      <option value="54">54</option>
      <option value="55">55</option>
      <option value="56">56</option>
      <option value="57">57</option>
      <option value="58">58</option>
      <option value="59">59</option>
      <option value="60">60</option>
      <option value="61">61</option>
      <option value="62">62</option>
      <option value="63">63</option>
      <option value="64">64</option>
      <option value="65">65</option>
      <option value="66">66</option>
      <option value="67">67</option>
      <option value="68">68</option>
      <option value="69">69</option>
      <option value="70">70</option>
      <option value="71">71</option>
      <option value="72">72</option>
      <option value="73">73</option>
      <option value="74">74</option>
      <option value="75">75</option>
      <option value="76">76</option>
      <option value="77">77</option>
      <option value="78">78</option>
      <option value="79">79</option>
      <option value="80">80</option>
    </select>
    Edad (hasta):
    <label for="type"></label>
    <select name="Hasta" id="type">
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
      <option value="32">32</option>
      <option value="33">33</option>
      <option value="34">34</option>
      <option value="35">35</option>
      <option value="36">36</option>
      <option value="37">37</option>
      <option value="38">38</option>
      <option value="39">39</option>
      <option value="40">40</option>
      <option value="41">41</option>
      <option value="42">42</option>
      <option value="43">43</option>
      <option value="44">44</option>
      <option value="45">45</option>
      <option value="46">46</option>
      <option value="47">47</option>
      <option value="48">48</option>
      <option value="49">49</option>  
      <option value="50">50</option>  
      <option value="51">51</option>
      <option value="52">52</option>
      <option value="53">53</option>
      <option value="54">54</option>
      <option value="55">55</option>
      <option value="56">56</option>
      <option value="57">57</option>
      <option value="58">58</option>
      <option value="59">59</option>
      <option value="60">60</option>
      <option value="61">61</option>
      <option value="62">62</option>
      <option value="63">63</option>
      <option value="64">64</option>
      <option value="65">65</option>
      <option value="66">66</option>
      <option value="67">67</option>
      <option value="68">68</option>
      <option value="69">69</option>
      <option value="70">70</option>
      <option value="71">71</option>
      <option value="72">72</option>
      <option value="73">73</option>
      <option value="74">74</option>
      <option value="75">75</option>
      <option value="76">76</option>
      <option value="77">77</option>
      <option value="78">78</option>
      <option value="79">79</option>
      <option value="80">80</option>
    </select>
    <br/><br/>    
    <input type="submit" value="Buscar">
  </form>
  </div>

  <div align="center" class="search">
  <h3 align="center"> ¿Quieres buscar los jefes de las unidades qué realizan despachos a dos comunas?</h3>

  <form align="center" action="consultas/consulta_5.php" method="post">
    Comuna 1:
    <input type="text" name="comuna1">
    <br/><br/>
    Comuna 2:
    <input type="text" name="comuna2">
    <br/><br/>  
    <input type="submit" value="Buscar">
  </form>
  </div>

  <div align="center" class="search">
  <h3 align="center"> ¿Quiere buscar la unidad que maneja más vehículos de un tipo?</h3>

  <form align="center" action="consultas/consulta_6.php" method="post">
    Tipo de vehículo:
    <input type="text" name="vehiculo">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  </div>
  
  <br>
  <br>
  <br>
  <br>
</body>
</html>
