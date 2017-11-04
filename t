[1mdiff --git a/src/Domain/AggregateRoot.php b/src/Domain/AggregateRoot.php[m
[1mindex 71438d5..953c9f7 100644[m
[1m--- a/src/Domain/AggregateRoot.php[m
[1m+++ b/src/Domain/AggregateRoot.php[m
[36m@@ -2,13 +2,16 @@[m
 [m
 namespace App\Domain;[m
 [m
[32m+[m[32muse App\Domain\Event;[m
[32m+[m[32muse App\Domain\EventCollection;[m
[32m+[m
 abstract class AggregateRoot [m
 {[m
     protected $guid;[m
 [m
     protected $version;[m
 [m
[31m-    protected $changes = new ArrayObject();[m
[32m+[m[32m    protected $changes;[m
 [m
     public function getUnCommitedChanges()[m
     {[m
[36m@@ -17,10 +20,10 @@[m [mabstract class AggregateRoot[m
 [m
     public function markChangesAsCommited()[m
     {[m
[31m-        $this->changes = new ArrayObject();[m
[32m+[m[32m        $this->changes = new \ArrayObject();[m
     }[m
 [m
[31m-    public function replayHistory(EventCollection history)[m
[32m+[m[32m    public function replayHistory(EventCollection $history)[m
     {[m
         foreach ($history as $event) {[m
             $this->applyChange($event, false);       [m
[36m@@ -40,7 +43,7 @@[m [mabstract class AggregateRoot[m
         }[m
     }[m
     [m
[31m-    protected function __call($method, $args)[m
[32m+[m[32m    public function __call($method, $args)[m
     {[m
         $event = $args[0];[m
         if (!$event instanceOf Event) {[m
[1mdiff --git a/src/Domain/EventCollection.php b/src/Domain/EventCollection.php[m
[1mindex 0d9c6b9..c79d6ef 100644[m
[1m--- a/src/Domain/EventCollection.php[m
[1m+++ b/src/Domain/EventCollection.php[m
[36m@@ -2,7 +2,9 @@[m
 [m
 namespace App\Domain;[m
 [m
[31m-final class EventCollection implements IteratorAggregate [m
[32m+[m[32muse App\Domain\Event;[m
[32m+[m
[32m+[m[32mfinal class EventCollection implements \IteratorAggregate[m[41m [m
 {[m
     private $events;[m
         [m
[36m@@ -18,7 +20,7 @@[m [mfinal class EventCollection implements IteratorAggregate[m
 [m
     public function getIterator()[m
     {[m
[31m-        return new ArrayIterator($this->events);[m
[32m+[m[32m        return new \ArrayIterator($this->events);[m
     }[m
 }[m
 [m
[1mdiff --git a/src/Domain/Repository.php b/src/Domain/Repository.php[m
[1mindex 23acad8..b899dbc 100644[m
[1m--- a/src/Domain/Repository.php[m
[1m+++ b/src/Domain/Repository.php[m
[36m@@ -2,11 +2,15 @@[m
 [m
 namespace App\Domain;[m
 [m
[31m-final class Repository implements RepositoryInterface[m
[32m+[m[32muse App\Domain\AggregateRoot;[m
[32m+[m[32muse App\Domain\EventStore;[m
[32m+[m[32muse App\Domain\RepositoryInterface;[m
[32m+[m
[32m+[m[32mclass Repository implements RepositoryInterface[m
 {[m
[31m-    private EventStore $eventStore;[m
[32m+[m[32m    private $eventStore;[m
 [m
[31m-    public function __construct(EventStore $eventStore) :void[m
[32m+[m[32m    public function __construct(EventStore $eventStore)[m
     {[m
         $this->eventStore = $eventStore;[m
     }[m
[36m@@ -18,7 +22,7 @@[m [mfinal class Repository implements RepositoryInterface[m
 [m
     public function getById($guid, string $aggregateClass)[m
     {[m
[31m-        $refClassAggr = ReflectionClass($aggregateClass);      [m
[32m+[m[32m        $refClassAggr = new \ReflectionClass($aggregateClass);[m[41m      [m
         $aggregate = $refClassAggr->newInstance();[m
         $history = $this->eventStore->getAggregateHistory($guid);[m
         $aggregate->replayHistory($history);[m
[1mdiff --git a/src/Domain/RepositoryInterface.php b/src/Domain/RepositoryInterface.php[m
[1mindex 12ad482..bc11ce1 100644[m
[1m--- a/src/Domain/RepositoryInterface.php[m
[1m+++ b/src/Domain/RepositoryInterface.php[m
[36m@@ -2,6 +2,8 @@[m
 [m
 namespace App\Domain;[m
 [m
[32m+[m[32muse App\Domain\AggregateRoot;[m
[32m+[m
 interface RepositoryInterface[m
 {[m
     public function save(AggregateRoot $aggregate, int $expectedVersion);[m
[1mdiff --git a/src/Domain/Travel/Entity/Holiday.php b/src/Domain/Travel/Entity/Holiday.php[m
[1mindex bd45a6f..9635c8c 100644[m
[1m--- a/src/Domain/Travel/Entity/Holiday.php[m
[1m+++ b/src/Domain/Travel/Entity/Holiday.php[m
[36m@@ -2,6 +2,8 @@[m
 [m
 namespace App\Domain\Travel\Entity;[m
 [m
[32m+[m[32muse App\Domain\AggregateRoot;[m
[32m+[m
 class Holiday extends AggregateRoot[m
 {[m
     private $startedAt;[m
