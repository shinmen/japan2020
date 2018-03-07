db = db.getSiblingDB("japan2020");
db.createCollection("flights_fares");
db.createUser({ user: "japan", pwd: "j536dE2eKMs", roles: [{ role:"dbOwner", db: "japan" }] });

