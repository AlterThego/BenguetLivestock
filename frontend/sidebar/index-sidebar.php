<aside id="sidebar" class="collapse show">
    <div class="h-100">
        <div class="sidebar-logo">
            <div class="row align-items-center">
                <div class="col-auto ml--1">
                    <img src="/BenguetLivestock/assets/images/logo.png" alt="Logo" style="height: 55px; width: 55px;">
                </div>
                <div class="col">
                    <a href="#" class="d-block fs-3 pr-1">Benguet Livestock</a>
                </div>
            </div>
        </div>
        <!-- Sidebar Navigation -->
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Menu
            </li>
            <li class="sidebar-item">
                <a href="/benguetlivestock/index.php" class="sidebar-link active" id="dashboard-link">
                    <img src="/BenguetLivestock/assets/images/dashboard.png" alt="Logo"
                        style="height: 25px; width: 25px;" class="img mr-2">
                    <strong>Dashboard</strong>
                </a>
            </li>



            <!-- Population -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#population"
                    aria-expanded="true" aria-controls="population" id="population-link">
                    <img src="/BenguetLivestock/assets/images/population.png" alt="Logo"
                        style="height: 25px; width: 25px;" class="img mr-2">
                    Population
                </a>


                <ul id="population" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/pets-population.php" class="sidebar-link"
                            id="livestock-population-link" data-bs-parent="#population"><img
                                src="/BenguetLivestock/assets/images/pets.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Pet
                            Population</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/poultry-population.php" class="sidebar-link"
                            id="livestock-population-link" data-bs-parent="#population"><img
                                src="/BenguetLivestock/assets/images/poultry.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Poultry
                            Population</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/animal-population.php" class="sidebar-link"
                            id="livestock-population-link" data-bs-parent="#population"><img
                                src="/BenguetLivestock/assets/images/livestock.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Animal
                            Population</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/livestock-volume.php" class="sidebar-link"
                            data-bs-parent="#population"><img src="/BenguetLivestock/assets/images/weight.png"
                                alt="Logo" style="height: 20px; width: 20px;" class="img mr-2 ml-4">Livestock
                            Volume</a>
                    </li>
                </ul>
            </li>

            <!-- Yearly -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#yearly"
                    aria-expanded="true" aria-controls="yearly" id="yearly-link">
                    <img src="/BenguetLivestock/assets/images/yearly.png" alt="Logo" style="height: 25px; width: 25px;"
                        class="img mr-2">Yearly
                </a>
                <ul id="yearly" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/pet-trend.php" class="sidebar-link"
                            data-bs-parent="#yearly"><img src="/BenguetLivestock/assets/images/poultry_trend.png"
                                alt="Logo" style="height: 20px; width: 20px;" class="img mr-2 ml-4">Pet Trend
                            (Yearly)</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/poultry-trend.php" class="sidebar-link"
                            data-bs-parent="#yearly"><img src="/BenguetLivestock/assets/images/poultry_trend.png"
                                alt="Logo" style="height: 20px; width: 20px;" class="img mr-2 ml-4">Poultry Trend
                            (Yearly)</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/animal-trend.php" class="sidebar-link"
                            data-bs-parent="#yearly"><img src="/BenguetLivestock/assets/images/livestock_volume.png"
                                alt="Logo" style="height: 20px; width: 20px;" class="img mr-2 ml-4">Animal
                            Trend
                            (Yearly)</a>
                    </li>


                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/livestock-volume-trend.php" class="sidebar-link"
                            data-bs-parent="#yearly"><img src="/BenguetLivestock/assets/images/weight.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Livestock Volume
                            Trend
                            (Yearly)</a>
                    </li>
                </ul>
            </li>


            <!-- Breeding and Farms -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#farms"
                    aria-expanded="false" aria-controls="farms">
                    <img src="/BenguetLivestock/assets/images/farm.png" alt="Logo" style="height: 25px; width: 25px;"
                        class="img mr-2">
                    Breeding and Farms
                </a>
                <ul id="farms" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/BenguetLivestock/frontend/breeding-stations.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/breeding_stations.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Breeding
                            Stations/Multiplier Farms/Demo Farms</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/BenguetLivestock/frontend/commercial-poultry.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/piggery_farm.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Commercial Poultry,
                            Cattle, and Piggery Farms</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/BenguetLivestock/frontend/veterinary-poultry.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/farm_supplies.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Number of Veterinary
                            and Poultry Farm Supplies</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#fish"
                    aria-expanded="false" aria-controls="fish">
                    <img src="/BenguetLivestock/assets/images/fish.png" alt="Logo" style="height: 25px; width: 25px;"
                        class="img mr-2">
                    Fishery Data
                </a>
                <ul id="fish" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/fish-sanctuary.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/fish_sanctuaries.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Fish
                            Sanctuaries/Estimated Area</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/fish-production.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/yearly_fish.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Yearly Fish
                            Production</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#bee"
                    aria-expanded="false" aria-controls="bee">
                    <img src="/BenguetLivestock/assets/images/bee.png" alt="Logo" style="height: 25px; width: 25px;"
                        class="img mr-2">
                    Beekeeping
                </a>
                <ul id="bee" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/bee-colonies.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/honey_bee.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Number of Honey Bee
                            Colonies/Number of Beekeepers</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/bee-trend.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/bee_colonies.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Yearly Honey Bee
                            Colonies and Beekeepers</a>
                    </li>

                </ul>
            </li>

            <!-- Health and Diseases -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#health"
                    aria-expanded="false" aria-controls="health">
                    <img src="/BenguetLivestock/assets/images/health.png" alt="Logo" style="height: 25px; width: 25px;"
                        class="img mr-2">
                    Health and Diseases
                </a>
                <ul id="health" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/common-diseases.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/yearly_deaths.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Common Animal
                            Diseases</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/animal-deaths.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/animal_death.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Number of Animal
                            Deaths due to Disease Infections</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/affected-animals.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/affected_animals.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Number of Animals
                            Affected with Diseases</a>
                    </li>
                </ul>
            </li>


            <!-- Veterinary Services -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#veterinary"
                    aria-expanded="false" aria-controls="veterinary">
                    <img src="/BenguetLivestock/assets/images/veterinary.png" alt="Logo"
                        style="height: 25px; width: 25px;" class="img mr-2">
                    Veterinary Services
                </a>
                <ul id="veterinary" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/benguetlivestock/frontend/veterinary-clinics.php" class="sidebar-link"><img
                                src="/BenguetLivestock/assets/images/clinic.png" alt="Logo"
                                style="height: 20px; width: 20px;" class="img mr-2 ml-4">Number of Veterinary
                            Clinics</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</aside>